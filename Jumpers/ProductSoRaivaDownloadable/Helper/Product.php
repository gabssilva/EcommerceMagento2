<?php

namespace Jumpers\ProductSoRaivaDownloadable\Helper;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Downloadable\Api\Data\LinkInterfaceFactory;
use Magento\Downloadable\Api\LinkRepositoryInterfaceFactory as LinkFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\State;

use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Input\Input;

class Product extends AbstractHelper
{
    const ARG_COUNT = 'count';
    const ARG_WEBSITE = 'website';

    const ARG_NAME = 'name';
    const ARG_GENRE = 'genre';
    const ARG_COMPANY = 'company';
    const ARG_AUTHOR = 'author';
    const ARG_PAGES = 'pages';
    const ARG_PRICE = 'price';
    const ARG_QTY = 'qty';
    const ARG_STORE = 'store';
    const ARG_CATEGORY = 'category';
    const ARG_SUBCATEGORY = 'sub';
    const ARG_IMAGE = 'image';
    const ARG_DOWNLOADS = 'download';
    const ARG_FILE = 'file';

    protected $storeManager;
    protected $state;
    protected $productFactory;
    protected $data;
    protected $linkFactory;
    protected $linkInterfaceFactory;

    protected $store;
    protected $category;
    protected $subCategory;
    protected $image;

    protected $nameProduct;
    protected $productPrice;
    protected $productQty;

    protected $productGenre;
    protected $productPublishingCompany;
    protected $productAuthor;
    protected $productNumberPages;
    protected $productNumberDownloads;
    protected $productFile;

    protected $categorySetupFactory;

    public function __construct(
        Context $context,
        ProductFactory $productFactory,
        State $state,
        StoreManagerInterface $storeManager,
        LinkFactory $linkFactory,
        LinkInterfaceFactory $linkInterfaceFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->storeManager = $storeManager;
        $this->state = $state;
        $this->productFactory = $productFactory;
        $this->linkFactory = $linkFactory;
        $this->linkInterfaceFactory = $linkInterfaceFactory;
        $this->categorySetupFactory = $categorySetupFactory;

        parent::__construct($context);
    }

    public function setData(Input $input)
    {
        $this->data = $input;
        return $this;
    }

    public function setInfoProduct(
        $nameProduct,
        $productGenre,
        $productPublishingCompany,
        $productAuthor,
        $productNumberPages,
        $productPrice,
        $productQty,
        $store,
        $category,
        $subcategory,
        $image,
        $productNumberDownloads,
        $productFile
    ) {
        $this->nameProduct = $nameProduct;
        $this->productGenre = $productGenre;
        $this->productPublishingCompany = $productPublishingCompany;
        $this->productAuthor = $productAuthor;
        $this->productNumberPages = $productNumberPages;
        $this->productPrice = $productPrice;
        $this->productQty = $productQty;
        $this->store = $store;
        $this->category = $category;
        $this->subCategory = $subcategory;
        $this->image = $image;
        $this->productNumberDownloads = $productNumberDownloads;
        $this->productFile = $productFile;
    }

    public function createProduct($count)
    {
        $product = $this->productFactory->create();
        $categorySetup = $this->categorySetupFactory->create();

        $productSKU = time() . $count;

        $product->setSku($productSKU);
        $product->setUrlKey($productSKU);
        $product->setName($this->nameProduct);
        $product->setAttributeSetId($categorySetup->getAttributeSetId('4', 'SoRaiva'));
        $product->setStatus(1);
        $product->setVisibility(4);
        $product->setTaxClassId(0);
        $product->setTypeId('downloadable'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice($this->productPrice);
        $product->setWeight(1);
        $product->setWebsiteIds([2]); // website ID
        $product->setCategoryIds([$this->store, $this->category, $this->subCategory]);
        $product->setStockData(
            [
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => $this->productQty
            ]
        );

        $product->setGenre($this->productGenre);
        $product->setPublishingCompany($this->productPublishingCompany);
        $product->setAuthor($this->productAuthor);
        $product->setNumberOfPages($this->productNumberPages);

        $imagePath = $this->image; // path of the image
        $product->addImageToMediaGallery($imagePath, ['image', 'small_image', 'thumbnail'], false, false);

        $product->save();

        $link_repository = $this->linkFactory->create();
        $link_interface = $this->linkInterfaceFactory->create();

        $link_interface->setTitle($this->nameProduct . ' - Para Download - ' . $productSKU);
        $link_interface->setPrice(10);
        $link_interface->setNumberOFDownloads($this->productNumberDownloads);
        $link_interface->setIsShareable(0);
        $link_interface->setLinkType('file');
        $link_interface->setLinkFile('/n/o/' . $this->productFile);
        $link_interface->setIsUnlimited(0);
        $link_interface->setSortOrder(0);
        $link_repository->save($productSKU, $link_interface);

        return $productSKU;
    }

    public function execute()
    {
        $this->state->setAreaCode('frontend');

        $count = $this->data->getOption(self::ARG_COUNT) ? $this->data->getOption(self::ARG_COUNT) : 1;
        $count = $count > 100 ? 100 : $count;

        for ($i = 1; $i <= $count; $i++) {
            $productSKU = $this->createProduct($i);
            echo $i . "- Product is created - SKU : " . $productSKU . "\n";
        }
    }
}
