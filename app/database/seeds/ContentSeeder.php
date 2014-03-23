<?php

class ContentSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $contentType = ContentType::create([
      'name' => 'Blog',
      'slug' => 'blog',
    ]);

    $titleRegion = Region::create([
      'name' => 'Title',
      'slug' => 'title',
    ]);
    $contentType->regions()->attach($titleRegion);

    $bodyRegion = Region::create([
      'name' => 'Body',
      'slug' => 'body',
    ]);
    $contentType->regions()->attach($bodyRegion);

    $textBlock = Block::create([
      'name' => 'Text',
      'slug' => 'text',
    ]);

    $textBlockContentField = new Field([
      'name' => 'Content',
      'slug' => 'content',
      'type' => 'TextField',
    ]);
    $textBlock->fields()->save($textBlockContentField);

    $paragraphBlock = Block::create([
      'name' => 'Paragraph',
      'slug' => 'paragraph',
    ]);
    $paragraphField = new Field([
      'name' => 'Content',
      'slug' => 'content',
      'type' => 'ParagraphField',
    ]);
    $paragraphBlock->fields()->save($paragraphField);

    $blockquoteBlock = Block::create([
      'name' => 'Blockquote',
      'slug' => 'blockquote',
    ]);

    $blockquoteQuoteField = new Field([
      'name' => 'Quote',
      'slug' => 'quote',
      'type' => 'TextField',
    ]);
    $blockquoteBlock->fields()->save($blockquoteQuoteField);

    $blockquoteCiteField = new Field([
      'name' => 'Cite',
      'slug' => 'cite',
      'type' => 'TextField',
    ]);
    $blockquoteBlock->fields()->save($blockquoteCiteField);
  }

}