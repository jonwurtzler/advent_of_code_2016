<?php


class DataLoader
{
    /**
     * @var string
     */
    static private $filePath = 'src/data/';

    /**
     * Setup full pathname
     *
     * @param string $filename
     *
     * @return string
     */
    static private function getFullPath($filename)
    {
        return self::$filePath . $filename;
    }

    /**
     * Treat data as an array
     *
     * @param string $filename
     *
     * @return array
     */
    static public function loadFileAsArrayData($filename)
    {
        $fullPath = self::getFullPath($filename);

        $fh = fopen($fullPath, 'r');

        if ($fh) {
            $a = [];

            while (false !== ($line = fgets($fh, 4096))) {
                $a[] = rtrim($line, "\n");
            }
        } else {
            throw new Exception("Failed to load file as array: " . $fullPath);
        }

        fclose($fh);

        return $a;
    }
}
