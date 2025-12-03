<?php
namespace Ps14\Site\Component;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Component\AbstractComponentCollection;
use TYPO3Fluid\Fluid\View\TemplatePaths;

class ComponentCollection extends AbstractComponentCollection
{
    public function getTemplatePaths(): TemplatePaths {
        $templatePaths = new TemplatePaths();
        $templatePaths->setTemplateRootPaths([
            ExtensionManagementUtility::extPath('ps14_component', 'Resources/Private/Components'),
            ExtensionManagementUtility::extPath('ps14_site', 'Resources/Private/Components'),
        ]);

        return $templatePaths;
    }
}
