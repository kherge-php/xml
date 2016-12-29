<?php

namespace Test\KHerGe\XML;

use KHerGe\XML\FileReader;
use KHerGe\XML\Node\NodeBuilderFactory;
use KHerGe\XML\Node\PathBuilderFactory;
use PHPUnit_Framework_TestCase as TestCase;

use function KHerGe\File\remove;
use function KHerGe\File\temp_file;

/**
 * Verifies that that the XML file reader functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 *
 * @coveres \KHerGe\XML\FileReader
 */
class FileReaderTest extends TestCase
{
    /**
     * The temporary XML file.
     *
     * @var string
     */
    private $file;

    /**
     * The XML file reader.
     *
     * @var FileReader
     */
    private $reader;

    /**
     * Verify that the XML file is read.
     */
    public function testReadANodeFromTheXmlFile()
    {
        foreach ($this->reader as $path => $node) {
            self::assertEquals(
                '/test',
                $path,
                'The expected path was not returned.'
            );

            self::assertEquals(
                'test',
                $node->getLocalName(),
                'The expected node was not read from the file.'
            );
        }
    }

    /**
     * Creates a new temporary XML file and reader.
     */
    protected function setUp()
    {
        $this->file = temp_file();

        file_put_contents($this->file, '<test/>');

        $this->reader = new FileReader(
            $this->file,
            0,
            new PathBuilderFactory(),
            new NodeBuilderFactory()
        );
    }

    /**
     * Deletes the temporary file.
     */
    protected function tearDown()
    {
        $this->reader = null;

        remove($this->file);
    }
}