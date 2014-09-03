<?php
namespace Bolt\Configuration;

/**
 * Inherits from default and adds some specific checks for composer installs.
 *
 * @author Ross Riley <riley.ross@gmail.com> 
 **/

class ComposerChecks extends LowlevelChecks
{
    
    public $composerSuffix = <<< EOM
    </strong></p><p>When using Bolt as a Composer package your install will to take the following steps:</p>
    <ol>
        <li>Create a local, writable config directory eg: <code>mkdir -p app/config && chmod -R 0777 app/config</code></li>
        <li>For a default SQLite install, create a local, writable directory eg: <code>mkdir -p app/database && chmod -R 0777 app/database</code></li>
        <li>Create a local, writable extensions directory eg: <code>mkdir -p extensions && chmod -R 0777 extensions</code></li>
    </ol><strong>
EOM;


    /**
     * The constructor requires a resource manager object to perform checks against.
     * This should ideally be typehinted to Bolt\Configuration\ResourceManager
     *
     * @return void
     **/
    public function __construct($config = null)
    {
        parent::__construct($config);
        $this->addCheck('config', true);
    }
    
    
    public function checkConfig()
    {                    
        if (!is_dir($this->config->getPath('config'))) {
            throw new LowlevelException(
                "The default folder <code>" . $this->config->getPath('config') . 
                "</code> doesn't exist. Make sure it's " .
                "present and writable to the user that the webserver is using.". $this->composerSuffix);
        } elseif (!is_writable($this->config->getPath('config'))) {
            throw new LowlevelException(
                "The default folder <code>" . $this->config->getPath('config') . 
                "</code> isn't writable. Make sure it's writable to the user that the webserver is using.".$this->composerSuffix
            );
        }
    }
    
    


}
