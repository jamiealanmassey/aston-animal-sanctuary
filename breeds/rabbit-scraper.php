<?php

$wiki_page = new DOMDocument();
$wiki_page->loadHTMLFile('https://en.wikipedia.org/wiki/List_of_rabbit_breeds');
$table = $wiki_page->getElementsByTagName('table');
$table_body = $table->item(0)->getElementsByTagName('tbody');
$table_rows = $table_body->item(0)->getElementsByTagName('tr');
$output = fopen('rabbit.breeds.txt', 'w');
$result = array();

// initial pass where we extract all the breeds from the wiki page
for($i = 0; $i < $table_rows->length; $i++)
{
    $table_data = $table_rows->item($i)->getElementsByTagName('td')->item(0);
    if (isset($table_data))
    {
        $table_entry = $table_data->getElementsByTagName('a');
        $table_input = $table_entry->item(0);

        if (isset($table_input))
        {
            $found = $table_input->textContent;
            $result[] = $found;
        }
    }
}

// [UK]/[US]/[NL] etc. stripping pass
for ($i = 0; $i < sizeof($result); $i++)
{
    $result[$i] = preg_replace('/(\[[A-Z\/]*\])/', '', $result[$i]);
    $result[$i] = trim($result[$i]);
}

// remove duplicates and write to file
$result = array_unique($result);
for ($i = 0; $i < sizeof($result); $i++)
{
    if (strlen($result[$i]) > 0)
    {
        fwrite($output, $result[$i] . "\n");
        print($result[$i] . "\n");
    }
}

// close file stream
fclose($output);
