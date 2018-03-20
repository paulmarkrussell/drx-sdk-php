<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class UserHistoryItem
{
    private $dateTime;
    private $note;
    private $source;
    private $internal;

    public function __construct($dateTime, $note, $source, $internal) {
        $this->dateTime = $dateTime;
        $this->note = $note;
        $this->source = $source;
        $this->internal = $internal;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getInternal()
    {
        return $this->internal;
    }
}