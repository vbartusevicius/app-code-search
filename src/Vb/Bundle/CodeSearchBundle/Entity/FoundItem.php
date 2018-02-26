<?php

namespace Vb\Bundle\CodeSearchBundle\Entity;

class FoundItem
{
    private $ownerName;
    private $repositoryName;
    private $fileName;

    /**
     * @return string|null
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * @param string|null $ownerName
     *
     * @return $this
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @param string|null $repositoryName
     *
     * @return $this
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }
}
