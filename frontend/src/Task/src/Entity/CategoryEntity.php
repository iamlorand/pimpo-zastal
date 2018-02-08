<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 08.02.2018
 * Time: 14:25
 */

namespace Frontend\Task\Entity;

use Dot\Mapper\Entity\Entity;

class CategoryEntity extends Entity
{
    /** @var  int */
    protected $id;

    /** @var  string */
    protected $title;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
