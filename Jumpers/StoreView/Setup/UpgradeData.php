<?php

namespace Jumpers\StoreView\Setup;

use Magento\Catalog\Model\CategoryFactory as Category;
use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Framework\Event\ManagerInterface;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\GroupFactory;
use Magento\Store\Model\ResourceModel\Group;
use Magento\Store\Model\ResourceModel\Store;
use Magento\Store\Model\ResourceModel\Website;
use Magento\Store\Model\StoreFactory;
use Magento\Store\Model\WebsiteFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $websiteFactory;
    private $website;
    private $groupFactory;
    private $group;
    private $storeFactory;
    private $store;
    private $managerInterface;
    private $categoryFactory;
    private $siteID;
    private $aldeiaID;
    private $soRaivaID;
    private $configInterface;

    public function __construct(
        WebsiteFactory $websiteFactory,
        Website $website,
        GroupFactory $groupFactory,
        Group $group,
        StoreFactory $storeFactory,
        Store $store,
        ManagerInterface $managerInterface,
        Category $categoryFactory,
        ConfigInterface $configInterface
    ) {
        $this->websiteFactory = $websiteFactory;
        $this->website = $website;
        $this->groupFactory = $groupFactory;
        $this->group = $group;
        $this->storeFactory = $storeFactory;
        $this->store = $store;
        $this->managerInterface = $managerInterface;
        $this->categoryFactory = $categoryFactory;
        $this->configInterface = $configInterface;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->createSite();
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->createGroupAldeiaTech();
            $this->createGroupSoRaiva();
        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $this->createStoreAldeiaTech();
            $this->createStoreSoRaiva();
        }

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $this->activationTheme();
        }
        $setup->endSetup();
    }

    private function createSite()
    {
        $site = $this->websiteFactory->create();

        $site->setCode('jumpers');
        $site->setName('Jumpers');
        $site->setDefaultGroupId(1);
        $site->setIsDefault(1);

        $this->website->save($site);
        $this->siteID = $site->getId();
    }

    private function createGroupAldeiaTech()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'aldeia_tech');

        $groupAldeia = $this->groupFactory->create();
        $groupAldeia->setWebsiteId($this->siteID);
        $groupAldeia->setCode('group_alteia_tech');
        $groupAldeia->setName('Aldeia Tech Group');
        $groupAldeia->setRootCategoryId($parentCategory->getId());

        $this->group->save($groupAldeia);
        $this->aldeiaID = $groupAldeia->getId();
    }

    private function createGroupSoRaiva()
    {
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->loadByAttribute('url_key', 'soraiva');

        $groupSoRaiva = $this->groupFactory->create();
        $groupSoRaiva->setWebsiteId($this->siteID);
        $groupSoRaiva->setCode('group_so_raiva');
        $groupSoRaiva->setName('SoRaiva Group');
        $groupSoRaiva->setRootCategoryId($parentCategory->getId());

        $this->group->save($groupSoRaiva);
        $this->soRaivaID = $groupSoRaiva->getId();
    }

    private function createStoreAldeiaTech()
    {
        $storeView = $this->storeFactory->create();

        $storeView->setCode('jumpers_aldeia');
        $storeView->setName('Aldeia Tech View');
        $storeView->setGroupId($this->aldeiaID);
        $storeView->setWebsiteId($this->siteID);
        $storeView->setData('is_active', '1');

        $this->store->save($storeView);
    }

    private function createStoreSoRaiva()
    {
        $storeView = $this->storeFactory->create();

        $storeView->setCode('jumpers_soraiva');
        $storeView->setName('SoRaiva View');
        $storeView->setGroupId($this->soRaivaID);
        $storeView->setWebsiteId($this->siteID);
        $storeView->setData('is_active', '1');

        $this->store->save($storeView);
    }

    protected function activationTheme()
    {
        $this->configInterface->saveConfig('design/theme/theme_id', 4, 'stores', 2);
        $this->configInterface->saveConfig('design/theme/theme_id', 5, 'stores', 3);
    }
}
