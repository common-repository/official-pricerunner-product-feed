<?php 

    namespace PricerunnerSDK\Generators;

    use Exception;
    use PricerunnerSDK\Errors\FileGeneratorErrors;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class FileGenerator
     * @package PricerunnerSDK\Generators
     */
    class FileGenerator
    {
        /**
         * @param string $filePath
         * @param string $content
         * @throws Exception
         */
        public function createDirAndFile($filePath, $content)
        {
            $fileDir = dirname($filePath);

            if(!$this->fileExists($fileDir)) {
                if(!$this->createDirectory($fileDir)) {
                    throw new Exception(
                        'Unable to create directory: \'' . $fileDir . '\', please check for write permissions.',
                        FileGeneratorErrors::UNABLE_TO_CREATE_DIRECTORY
                    );
                }
            }

            if(!$this->isWritable($fileDir)) {
                throw new Exception(
                    'Directory: \'' . $fileDir . '\', is not writable, please check for write permissions.',
                    FileGeneratorErrors::DIR_NOT_WRITABLE
                );
            }

            if(!$this->saveFile($filePath, $content)){
                throw new Exception(
                    'Error writing to the file: \'' . $filePath . '\', please check for write permissions.',
                    FileGeneratorErrors::FILE_NOT_WRITABLE
                );
            }
        }

        /**
         * @param string $filePath
         * @throws Exception
         */
        public function testFilePath($filePath)
        {
            if($this->fileExists($filePath)) {
                if(!$this->isWritable($filePath)) {
                    throw new Exception(
                        'File: \'' . $filePath . '\', is not writable, please check for write permissions.',
                        FileGeneratorErrors::FILE_NOT_WRITABLE
                    );
                }
            } else {
                $fileDir = dirname($filePath);

                if(!$this->fileExists($fileDir)) {
                    if(!$this->createDirectory($fileDir)) {
                        throw new Exception(
                            'Unable to create directory: \'' . $fileDir . '\', please check for write permissions.',
                            FileGeneratorErrors::UNABLE_TO_CREATE_DIRECTORY
                        );
                    }
                }

                if(!$this->isWritable($fileDir)) {
                    throw new Exception(
                        'Directory: \'' . $fileDir . '\', is not writable, please check for write permissions.',
                        FileGeneratorErrors::DIR_NOT_WRITABLE
                    );
                }

                if(!$this->saveFile($filePath, "")) {
                    throw new Exception(
                        'Error writing to the file: \'' . $filePath . '\', please check for write permissions.',
                        FileGeneratorErrors::FILE_NOT_WRITABLE
                    );
                }

                $this->deleteFile($filePath);
            }
        }

        /**
         * @param string $filePath
         * @return bool
         */
        public function deleteFile($filePath)
        {
            return unlink($filePath);
        }

        /**
         * @param string $filePath
         * @return bool
         */
        public function isWritable($filePath)
        {   
            return is_writable($filePath);
        }

        /**
         * @param string $filePath
         * @param string $content
         * @return bool
         */
        public function saveFile($filePath, $content)
        {
            return @file_put_contents($filePath, $content) !== false;
        }

        /**
         * @param string $dir
         * @return bool
         */
        public function fileExists($dir)
        {
            return file_exists($dir);
        }

        /**
         * @param string $dir
         * @return bool
         */
        public function createDirectory($dir)
        {
            return mkdir($dir, 0775, true);
        }
    }
