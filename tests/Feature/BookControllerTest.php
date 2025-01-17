<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    // Use RefreshDatabase trait to refresh the database between tests
    use RefreshDatabase;

    // Test the index route, which should return a 200 status code
    public function testIndex()
    {
        // Send a GET request to the index route
        $response = $this->get('/');
        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }

    // Test saving a new book
    public function testSaveBook()
    {
        // Define the data for the new book
        $data = [
            'title' => 'Test Book',
            'author' => 'Test Author',
        ];

        // Send a POST request to the book save route with the defined data
        $response = $this->post('/book/save', $data);

        // Check the response status code
        if ($response->getStatusCode() === 302) {
            // If the status code is 302 (redirect), assert the response is a redirect
            $response->assertRedirect();
            // Follow the redirect and assert the final status is 200
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            // If the status code is not a redirect, assert it is 201 (created)
            $response->assertStatus(201);
        }
    }

    // Test deleting a book
    public function testDeleteBook()
    {
        // Create a book using the factory
        $book = Book::factory()->create();

        // Send a GET request to the book delete route with the book's ID
        $response = $this->get("/book/delete/{$book->id}");

        // Check the response status code
        if ($response->getStatusCode() === 302) {
            // If the status code is 302 (redirect), assert the response is a redirect
            $response->assertRedirect();
            // Follow the redirect and assert the final status is 200
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            // If the status code is not a redirect, assert it is 200 (OK)
            $response->assertStatus(200);
        }
    }

    // Test editing a book
    public function testEditBook()
    {
        // Create a book using the factory
        $book = Book::factory()->create();

        // Send a GET request to the book edit route with the book's ID
        $response = $this->get("/book/edit/{$book->id}");

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }

    // Test updating a book
    public function testUpdateBook()
    {
        // Create a book using the factory
        $book = Book::factory()->create();

        // Define the data for updating the book
        $data = [
            'id' => $book->id,
            'title' => 'Updated Title',
            'author' => 'Updated Author',
        ];

        // Send a POST request to the book update route with the defined data
        $response = $this->post('/book/update', $data);

        // Check the response status code
        if ($response->getStatusCode() === 302) {
            // If the status code is 302 (redirect), assert the response is a redirect
            $response->assertRedirect();
            // Follow the redirect and assert the final status is 200
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            // If the status code is not a redirect, assert it is 200 (OK)
            $response->assertStatus(200);
        }
    }

    // Test exporting books
    public function testExportBooks()
    {
        // Define the data for exporting books
        $data = [
            'fields' => ['title', 'author'], // Example fields, adjust as needed
            'export_type' => 'csv',
        ];

        // Send a POST request to the export route with the defined data
        $response = $this->post('export', $data);

        // Check the response status code
        if ($response->getStatusCode() === 302) {
            // If the status code is 302 (redirect), assert the response is a redirect
            $response->assertRedirect();
            // Follow the redirect and assert the final status is 200
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            // If the status code is not a redirect, assert it is 200 (OK)
            $response->assertStatus(200);
        }
    }

    public function testSearchBooks()
    {
        // Create 10 books using the factory
        $books = Book::factory()->count(10)->create();

        // Use the title of the first book for the search query
        $response = $this->get('/?search=' . $books->first()->title);
        
        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
        
        // Assert that the response contains the title of the first book
        $response->assertSee($books->first()->title);
    }
    
    // Test sorting books by title in ascending order
    public function testSortBooksByTitleAsc()
    {
        // Create 3 books with specific titles
        Book::factory()->create(['title' => 'A Title', 'author' => 'Author A']);
        Book::factory()->create(['title' => 'B Title', 'author' => 'Author B']);
        Book::factory()->create(['title' => 'C Title', 'author' => 'Author C']);

        // Send a GET request to sort by title in ascending order
        $response = $this->get('/?sort=title_asc');
        
        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
        
        // Assert that the titles are in ascending order
        $response->assertSeeInOrder(['A Title', 'B Title', 'C Title']);
    }

    // Test sorting books by author in ascending order
    public function testSortBooksByAuthorAsc()
    {
        // Create 3 books with specific authors
        Book::factory()->create(['title' => 'Title A', 'author' => 'Author A']);
        Book::factory()->create(['title' => 'Title B', 'author' => 'Author B']);
        Book::factory()->create(['title' => 'Title C', 'author' => 'Author C']);

        // Send a GET request to sort by author in ascending order
        $response = $this->get('/?sort=author_asc');
        
        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
        
        // Assert that the authors are in ascending order
        $response->assertSeeInOrder(['Author A', 'Author B', 'Author C']);
    }
}
?>
