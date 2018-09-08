<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\CzechDataBox\Request;

use HelpPC\CzechDataBox\IRequest;
use JMS\Serializer\Annotation as Serializer;
use Nette\Utils\Strings;

/**
 * Class ChangeISDSPassword
 * @package HelpPC\CzechDataBox\Request
 * @Serializer\XmlNamespace(uri="http://isds.czechpoint.cz/v20",prefix="p")
 * @Serializer\XmlRoot(name="p:ChangeISDSPassword",namespace="http://isds.czechpoint.cz/v20")
 */
class ChangeISDSPassword implements IRequest
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("p:dbOldPassword")
     * @Serializer\XmlElement(cdata=false)
     */
    protected $oldPassword;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("p:dbNewPassword")
     * @Serializer\XmlElement(cdata=false)
     */
    protected $newPassword;

    /**
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * @param string $oldPassword
     * @return ChangeISDSPassword
     */
    public function setOldPassword(string $oldPassword): ChangeISDSPassword
    {
        $this->oldPassword = $oldPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     * @return ChangeISDSPassword
     * @throws \Exception
     */
    public function setNewPassword(string $newPassword): ChangeISDSPassword
    {
        $pwdLen = Strings::length($newPassword);
        if (
            $pwdLen < 8 ||
            $pwdLen > 32 ||
            preg_match("/^[a-z0-9\!\#\$\*\%\&\(\)\*\+\,\-\:\=\?\@\[\]\_\{\|\}\~]+$/i", $newPassword) == false ||
            preg_match('/[A-Z]/', $newPassword) == false ||
            preg_match('/[a-z]/', $newPassword) == false ||
            preg_match('/[0-9]/', $newPassword) == false ||
            Strings::startsWith($newPassword, 'qwert') ||
            Strings::startsWith($newPassword, 'asdgf') ||
            Strings::startsWith($newPassword, '123456')
        ) {
            throw new \Exception('Password does not meet the requirements. Password must be between 8 and 32 chars and may not start with the following values "qwert", "asdgf", "123456". ');
        }

        $this->newPassword = $newPassword;
        return $this;
    }


}