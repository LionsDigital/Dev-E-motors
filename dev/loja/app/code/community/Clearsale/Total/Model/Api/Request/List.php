<?php

class Clearsale_Total_Model_Api_Request_List implements JsonSerializable
{
    use Clearsale_Total_Model_Api_Request_Trait_ConvertToArray;

    private $typeID;
    private $id;

    /**
     *
     * @return string
     */
    public function getTypeID()
    {
        return $this->typeID;
    }

    /**
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param string $typeID
     * @return List
     */
    public function setTypeID($typeID)
    {
        if (empty($typeID)) {
            throw new InvalidArgumentException('TypeID is empty!');
        }

        $this->typeID = $typeID;
    }

    /**
     *
     * @param integer $id
     * @return List
     */
    public function setId($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is empty!');
        }

        $this->id = $id;
    }

    public function jsonSerialize()
    {

        return $this->toArray();
    }
}
