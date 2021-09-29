<?php namespace Takielias\CodeigniterWebsocket\Controllers;

use CodeIgniter\Controller;

/**
 * @package   CodeIgniter WebSocket Library: Websocket Controller
 * @category  Libraries
 * @author    Taki Elias <taki.elias@gmail.com>
 * @license   http://opensource.org/licenses/MIT > MIT License
 * @link      https://github.com/takielias
 *
 * CodeIgniter WebSocket library. It allows you to make powerful realtime applications by using Ratchet Websocket
 */
class Websocket extends Controller
{
    /**
     * @var Config
     */
    protected $config;
    
    /**
     * @var CodeigniterWebsocket 
     */
    protected CodeigniterWebsocket $service;

    public function __construct()
    {
        $this->config = config('CodeigniterWebsocket');
    }

    public function start()
    {
        $this->service = service('CodeigniterWebsocket');
        $this->service->set_callback('auth', array($this, '_auth'));
        $this->service->set_callback('event', array($this, '_event'));
        $this->service->set_callback('citimer', array($this, '_citimer'));
        $this->service->run();
    }

    public function user($user_id = null)
    {
        return view('Websocket/websocket_message', array('user_id' => $user_id));
    }

    public function _auth($datas = null)
    {
        // Here you can verify everything you want to perform user login.

        return (!empty($datas->user_id)) ? $datas->user_id : false;
    }

    public function _event($datas = null)
    {
        // Here you can do everyting you want, each time message is received
        echo 'Hey ! I\'m an EVENT callback' . PHP_EOL;
    }
    
    public function _citimer($datetime = null)
    {
       foreach ($this->service->server->clients as $client) {
           //Can send message for all users
        }
    }
}
