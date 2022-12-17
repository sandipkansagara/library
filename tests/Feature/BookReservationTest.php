<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_book_can_be_added_to_library(){
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Fist Book',
            'author' => 'First Author'
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    public function test_a_title_is_required(){
        //$this->withoutExceptionHandling();
         
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'First Author'
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_author_is_required(){
        //$this->withoutExceptionHandling();
         
        $response = $this->post('/books', [
            'title' => 'First title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Fist Book',
            'author' => 'First Author'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/'.$book->id, [
            'title' => 'Second Book',
            'author' => 'Second Author'
        ]);

        $response->assertOk();

        $this->assertEquals('Second Book', Book::first()->title);
        $this->assertEquals('Second Author', Book::first()->author);
        
    }
}
