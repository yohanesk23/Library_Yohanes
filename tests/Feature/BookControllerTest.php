<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testSaveBook()
    {
        $data = [
            'title' => 'Test Book',
            'author' => 'Test Author',
        ];
        $response = $this->post('/book/save', $data);

        if ($response->getStatusCode() === 302) {
            $response->assertRedirect();
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            $response->assertStatus(201);
        }
    }

    public function testDeleteBook()
    {
        $book = Book::factory()->create();
        $response = $this->get("/book/delete/{$book->id}");

        if ($response->getStatusCode() === 302) {
            $response->assertRedirect();
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            $response->assertStatus(200);
        }
    }

    public function testEditBook()
    {
        $book = Book::factory()->create();
        $response = $this->get("/book/edit/{$book->id}");
        $response->assertStatus(200);
    }

    public function testUpdateBook()
    {
        $book = Book::factory()->create();
        $data = [
            'id' => $book->id,
            'title' => 'Updated Title',
            'author' => 'Updated Author',
        ];
        $response = $this->post('/book/update', $data);

        if ($response->getStatusCode() === 302) {
            $response->assertRedirect();
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            $response->assertStatus(200);
        }
    }

    public function testExportBooks()
    {
        $data = [
            'fields' => ['title', 'author'], // example fields, adjust as needed
            'export_type' => 'csv',
        ];
        $response = $this->post('export', $data);

        if ($response->getStatusCode() === 302) {
            $response->assertRedirect();
            $response = $this->followRedirects($response);
            $response->assertStatus(200);
        } else {
            $response->assertStatus(200);
        }
    }
}
