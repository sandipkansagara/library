<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_book_can_be_added_to_library(){
        $response = $this->post('/books', [
            'title' => 'Fist Book',
            'author' => 'First Author'
        ]);

        //$response->assertOk();

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    public function test_a_title_is_required(){
         
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'First Author'
        ]);

        $response->assertSessionHasErrors('title');
        
    }

    public function test_a_author_is_required(){
         
        $response = $this->post('/books', [
            'title' => 'First title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated(){

        $response = $this->post('/books', [
            'title' => 'Fist Book',
            'author' => 'First Author'
        ]);

        $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'Second Book',
            'author' => 'Second Author'
        ]);

        //$response->assertOk();

        $this->assertEquals('Second Book', Book::first()->title);
        $this->assertEquals('Second Author', Book::first()->author);

        $response->assertRedirect($book->fresh()->path());
    }

    public function test_a_book_can_be_deleted(){
        
        $response = $this->post('/books', [
            'title' => 'Fist Book',
            'author' => 'First Author'
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());
        //$response->assertOk();
        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }
}
