<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_store_a_product(): void
    {
        $thumbnail = UploadedFile::fake()->image('thumbnail.jpg');
        $galleryImages = [
            UploadedFile::fake()->image('gallery1.jpg'),
            UploadedFile::fake()->image('gallery2.jpg'),
        ];

        $requestData = [
            'name'        => 'Test Product',
            'qty'         => 10,
            'price'       => 19.99,
            'thumbnail'   => $thumbnail,
            'gallery'     => $galleryImages,
            'description' => 'Test description',
        ];

        $response = $this->post(route('product.store'), $requestData);

        // Assert the guest is redirected to login
        $response->assertRedirect(route('login'));

        // Assert the product was not created in the database
        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
        ]);
    }

    public function test_authenticated_user_can_store_a_product(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');

        $thumbnail = UploadedFile::fake()->image('thumbnail.jpg');
        $galleryImages = [
            UploadedFile::fake()->image('gallery1.jpg'),
            UploadedFile::fake()->image('gallery2.jpg'),
        ];


        $requestData = [
            'name'        => 'Test Product',
            'qty'         => 10,
            'price'       => 19.99,
            'thumbnail'   => $thumbnail,
            'gallery'     => $galleryImages,
            'description' => 'Test description',
        ];

        $response = $this->post(route('product.store'), $requestData);

        $response->assertRedirect(route('product.index'))
            ->assertSessionHas('success', 'Product created successfully.');

        // Assert the product exists in the database
        $this->assertDatabaseHas('products', [
            'name'        => 'Test Product',
            'slug'        => Str::slug('Test Product'),
            'qty'         => 10,
            'price'       => 19.99,
            'description' => 'Test description',
        ]);

        $product = Product::where('name', 'Test Product')->first();
        $this->assertNotNull($product);

        // Assert the product gallery was created
        $this->assertEquals(count($galleryImages), $product->productGallery()->count());

        // Assert the files were stored
        foreach ($product->productGallery as $galleryItem) {
            Storage::disk('public')->assertExists($galleryItem->image);
        }

        Storage::disk('public')->assertExists($product->thumbnail);
    }

    public function test_authenticated_user_can_update_a_product(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');

        $product = Product::factory()->create([
            'name'        => 'Old Product',
            'qty'         => 5,
            'price'       => 10.00,
            'description' => 'Old description',
        ]);

        $thumbnail = UploadedFile::fake()->image('new_thumbnail.jpg');
        $galleryImages = [
            UploadedFile::fake()->image('new_gallery1.jpg'),
            UploadedFile::fake()->image('new_gallery2.jpg'),
        ];

        $requestData = [
            'name'        => 'Updated Product',
            'qty'         => 20,
            'price'       => 29.99,
            'thumbnail'   => $thumbnail,
            'gallery'     => $galleryImages,
            'description' => 'Updated description',
        ];

        $response = $this->put(route('product.update', $product), $requestData);

        $response->assertRedirect(route('product.index'))
            ->assertSessionHas('success', 'Product Updated successfully.');

        // Assert the product was updated in the database
        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            'name'        => 'Updated Product',
            'slug'        => Str::slug('Updated Product'),
            'qty'         => 20,
            'price'       => 29.99,
            'description' => 'Updated description',
        ]);

        // Assert the files were updated
        Storage::disk('public')->assertExists($product->refresh()->thumbnail);

        $this->assertEquals(count($galleryImages), $product->productGallery()->count());

        foreach ($product->productGallery as $galleryItem) {
            Storage::disk('public')->assertExists($galleryItem->image);
        }
    }

    public function test_authenticated_user_can_delete_product_gallery(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');

        $productGallery = ProductGallery::factory()->create([
            'image' => 'gallery_image.jpg',
        ]);

        // Fake the file to ensure it exists
        Storage::disk('public')->put($productGallery->image, 'dummy content');

        $response = $this->get(route('product.gallery.delete', $productGallery));

        $response->assertRedirect();

        // Assert the file was deleted
        Storage::disk('public')->assertMissing($productGallery->image);

        // Assert the gallery entry was deleted from the database
        $this->assertDatabaseMissing('product_galleries', [
            'id' => $productGallery->id,
        ]);
    }

//    public function test_authenticated_user_can_delete_product(): void
//    {
//        $this->withoutExceptionHandling();
//        $user = User::factory()->create();
//        $this->actingAs($user);
//
//        Storage::fake('public');
//
//        // Create a product with a thumbnail and gallery images
//        $product = Product::factory()->create([
//            'thumbnail' => 'thumbnail.jpg',
//        ]);
//
//        $productGallery1 = $product->productGallery()->create(['image' => 'gallery1.jpg']);
//        $productGallery2 = $product->productGallery()->create(['image' => 'gallery2.jpg']);
//
//        // Fake the file existence
//        Storage::disk('public')->put('thumbnail.jpg', 'dummy content');
//        Storage::disk('public')->put('gallery1.jpg', 'dummy content');
//        Storage::disk('public')->put('gallery2.jpg', 'dummy content');
//
//        // Send the delete request
//        $response = $this->delete(route('product.destroy', $product));
//
//        $response->assertRedirect(route('product.index'))
//            ->assertSessionHas('success', 'Product deleted successfully.');
//
//        // Assert the product is deleted from the database
//        $this->assertDatabaseMissing('products', ['id' => $product->id]);
//
//        // Assert the gallery items are deleted from the database
//        $this->assertDatabaseMissing('product_galleries', ['product_id' => $product->id]);
//
//        // Assert the files were deleted from storage
//        Storage::disk('public')->assertMissing('thumbnail.jpg');
//        Storage::disk('public')->assertMissing('gallery1.jpg');
//        Storage::disk('public')->assertMissing('gallery2.jpg');
//    }

}
