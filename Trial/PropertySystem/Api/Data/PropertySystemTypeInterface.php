<?php
/**
 * @author Umer
 * @copyriht Copyright (c) 2022 Umer
 * Created by PhpStorm
 * User: Umer
 * Date: 7/3/22
 * Time: 1:40 AM
 */
namespace Trial\PropertySystem\Api\Data;

/**
 * Interface class having getter\setter
 *
 * Property System Interface
 */
interface PropertySystemTypeInterface
{
    /**#@+
     * Constants for keys of data array.
     */
    const TYPE_ID                 = 'type_id';
    const TITLE                   = 'title';
    const DESCRIPTION             = 'description';
    const CREATED_AT              = 'created_at';
    const UPDATED_AT              = 'updated_at';

    public function getTypeId();
    public function getTitle();
    public function getDescription();
    public function getCreatedAt();
    public function getUpdatedAt();
    public function setTypeId($typeId);
    public function setTitle($title);
    public function setDescription($description);
    public function setCreatedAt($createdAt);
    public function setUpdatedAt($updatedAt);
}
