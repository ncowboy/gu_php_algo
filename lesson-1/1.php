<?php

class Explorer
{
    protected $path;
    protected $iterator;
    protected $breadcrumbs;

    public function __construct($path)
    {
        $this->iterator = new DirectoryIterator($path);
        $this->breadcrumbs = new SplStack();
        $this->breadcrumbs->push($path);
    }

    /**
     * @return DirectoryIterator
     */
    public function getIterator()
    {
        return $this->iterator;
    }

    /**
     *
     */
    public function view()
    {
        foreach ($this->iterator as $file) {
            echo $file . PHP_EOL;
        }
    }

    public function run($path)
    {
        $iteratorArr = [];
        foreach ($this->iterator as $value) {
            $iteratorArr[] = (string)$value;
        }
        $key = array_search($path, $iteratorArr);
        if ($key) {
            $this->iterator->seek($key);
        }
        if ($this->iterator->isDir()) {
            $this->openDir($path);
        } else if ($this->iterator->isFile()) {
            $this->openFile($path);
        } else if ($this->iterator->current() === '..') {
            $this->goBack();
        } else {
            die();
        }
    }

    /**
     * @param $dir
     */

    protected function openDir($dir)
    {
        $newDir = $this->breadcrumbs->top() . '/' . $dir;
        $this->iterator = new DirectoryIterator($newDir);
        $this->breadcrumbs->push($newDir);
    }

    protected function goBack()
    {
        $this->breadcrumbs->pop();
        $this->iterator = new DirectoryIterator($this->breadcrumbs->top());
    }

    protected function openFile($file)
    {
        $file = new SplFileObject($this->breadcrumbs->top() . '/' . $file);
        echo $file->fpassthru() . PHP_EOL;
    }

    /**
     * @return SplStack
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

}

$explorer = new Explorer('/home/cangreen');
$explorer->run('gu_php2');
$explorer->run('.gitignore');

