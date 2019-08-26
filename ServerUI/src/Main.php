<?php
/*
  ╔═╗┌─┐┬─┐┬  ┬┌─┐┬─┐╦ ╦╦                 
  ╚═╗├┤ ├┬┘└┐┌┘├┤ ├┬┘║ ║║                 
  ╚═╝└─┘┴└─ └┘ └─┘┴└─╚═╝╩                 
  ┌┐ ┬ ┬  ┌─┐ ╦┬ ┬┌─┐┌┬┐╔╦╗┌─┐┬─┐┌─┐┌─┐┬  
  ├┴┐└┬┘  ┌─┘ ║│ │└─┐ │ ║║║├─┤├┬┘│  ├┤ │  
  └─┘ ┴   └─┘╚╝└─┘└─┘ ┴ ╩ ╩┴ ┴┴└─└─┘└─┘┴─┘
*/
namespace ServerUI;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	public $prefix = '§8[§aServer§cUI §9>§8] §7';
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info($this->prefix . " §7Enabled by zJustMarcel");
    }
    public function onDisable() {
        $this->getLogger()->info($this->prefix . " §7Disabled by zJustMarcel");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "serverui":
                if ($sender->hasPermission("serverui.use")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage($this->prefix . " §cDu hast keine Rechte!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
				$sender->setGameMode(1);
				$sender->sendMessage($this->prefix . " §7GameMode changed to §9Creative§4!");
                break;	
				case 1:
				$sender->setGameMode(0);
				$sender->sendMessage($this->prefix . " §7GameMode changed to §9Survival§4!");
				break;
				case 2;
				$sender->setGameMode(3);
				$sender->sendMessage($this->prefix . " §7Your §6GameMode §7has been set to §33§r§4!");
				break;
				case 3;
				$sender->setAllowFlight(true);
				$sender->sendMessage($this->prefix . " §7Your §6Fly-Mode §7has been activated§4!");
				break;
				case 4;
				$sender->setAllowFlight(false);
				$sender->sendMessage($this->prefix . " §7Your §6Fly-Mode §7has been §cDeactivated§4!");
				break;
				case 5;
				$sender->setHealth(20);
				$sender->sendMessage($this->prefix . " §7You has been §6Healed§4!");
				break;
				case 6;
				$sender->setFood(20);
				$sender->sendMessage($this->prefix . " §7You are not §6Hungry§4!");
				break;
                case 7:
				$sender->sendMessage($this->prefix . " §7You has been §4Closed §7the §aServerUI");
            }
            
            
            });
            $form->setTitle("§7-= §l§9ServerUI§r §7=-");
			$form->setContent("§o§7SererUI By zJustMarcel");
			$form->addButton("§o§9GM-1\n§r§o§7Tap to Select", 0);
			$form->addButton("§o§9GM-0§r\n§7§oTap to set to §31§r", 1);
			$form->addButton("§o§9GM-3§r\n§o§7Tap to set to §33", 2);
			$form->addButton("§o§9Fly §aon§r\n§7§oTap to set §aOn§r", 3);
			$form->addButton("§o§9Fly §cOff§r\n§7§oTap to set §cOff§r", 4);
			$form->addButton("§o§9Heal\n§r§o§7Tap to Select", 5);
			$form->addButton("§o§9Feed§r\n§o§7Tap to Select", 6);
            $form->addButton("§l§4CLOSE§r\n§7Tap to Select", 7);
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
