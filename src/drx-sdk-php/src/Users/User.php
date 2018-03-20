<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;

require_once __DIR__."/UserHistoryItem.php";


class User
{
    private $guid;
    private $encodedEmail;
    private $emailMask;
    private $status;
    private $history;
    private $rms;
    private $organisation;
    private $accont;

    /**
     * @param mixed $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @param mixed $encodedEmail
     */
    public function setEncodedEmail($encodedEmail)
    {
        $this->encodedEmail = $encodedEmail;
    }

    /**
     * @return mixed
     */
    public function getEncodedEmail()
    {
        return $this->encodedEmail;
    }

    /**
     * @param mixed $emailMask
     */
    public function setEmailMask($emailMask)
    {
        $this->emailMask = $emailMask;
    }

    /**
     * @return mixed
     */
    public function getEmailMask()
    {
        return $this->emailMask;
    }

    /**
     * @param mixed $rms
     */
    public function setRms($rms)
    {
        $this->rms = $rms;
    }

    /**
     * @return mixed
     */
    public function getRms()
    {
        return $this->rms;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $accont
     */
    public function setAccont($accont)
    {
        $this->accont = $accont;
    }

    /**
     * @return mixed
     */
    public function getAccont()
    {
        return $this->accont;
    }

    /**
     * @param mixed $history
     */
    public function setHistory($history)
    {
        $this->history = [];
        foreach ($history as $item) {
            array_push($this->history, new UserHistoryItem($item->dateTime, $item->note, $item->source, $item->internal));
        }
    }

    /**
     * @return UserHistoryItem[]
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;
    }

    /**
     * @return mixed
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }
}