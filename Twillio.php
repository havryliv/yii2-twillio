<?php
/**
 * @author Bryan Tan <bryantan16@gmail.com>
 */

namespace havryliv\twillio;

use yii\base\Component;
use yii\base\InvalidConfigException;

class Twillio extends Component
{
    public $sid;
    public $token;

    public $signingKeySid;
    public $signingKeySecret;

    private $_client = null;
    private $_clientCapability = null;
    private $_accessToken = null;

    public function init()
    {
        if (!$this->sid) {
            throw new InvalidConfigException('SID is required');
        }
        if (!$this->token) {
            throw new InvalidConfigException('Token is required');
        }
    }

    /**
     * @return null|\Services_Twilio
     */
    public function getClient()
    {
        if ($this->_client === null) {
            $client = new \Services_Twilio($this->sid, $this->token);
            $this->_client = $client;
        }

        return $this->_client;
    }

    /**
     * @return null|\Services_Twilio_Capability
     */
    public function getClientCapability()
    {
        if ($this->_clientCapability === null) {
            $client = new \Services_Twilio_Capability($this->sid, $this->token);
            $this->_clientCapability = $client;
        }

        return $this->_clientCapability;
    }

    /**
     * @return null|\Services_Twilio_AccessToken
     */
    public function getAccessToken() {
        if ($this->_accessToken === null) {
            $client = new \Services_Twilio_AccessToken($this->signingKeySid, $this->sid, $this->signingKeySecret);
            $this->_accessToken = $client;
        }

        return $this->_accessToken;
        
    }
} 
