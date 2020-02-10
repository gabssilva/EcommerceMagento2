<?php

namespace Jumpers\ProductSoRaivaDownloadable\Console;

use Jumpers\ProductSoRaivaDownloadable\Helper\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProductCommand extends Command
{
    protected $productHelper;

    public function __construct(Product $productHelper)
    {
        $this->productHelper = $productHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('jumpers:product:create:dw')
            ->setDescription('Create New Product')
            ->setDefinition($this->getOptionsList());

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName = $input->getOption(product::ARG_NAME);
        $productGenre = $input->getOption(product::ARG_GENRE);
        $productPublishingCompany = $input->getOption(product::ARG_COMPANY);
        $productAuthor = $input->getOption(product::ARG_AUTHOR);
        $productNumberPages = $input->getOption(product::ARG_PAGES);
        $productPrice = $input->getOption(product::ARG_PRICE);
        $productQty = $input->getOption(product::ARG_QTY);
        $store = $input->getOption(product::ARG_STORE);
        $category = $input->getOption(product::ARG_CATEGORY);
        $subcategory = $input->getOption(product::ARG_SUBCATEGORY);
        $image = $input->getOption(product::ARG_IMAGE);
        $productNumberDownloads = $input->getOption(product::ARG_DOWNLOADS);
        $productFile = $input->getOption(product::ARG_FILE);

        $this->productHelper->setInfoProduct(
            $productName,
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
        );

        $output->writeln('<info>Creating Products</info>');
        $this->productHelper->setData($input);
        $this->productHelper->execute();
        $output->writeln($productName . '<info> Product is created.</info>');
    }

    protected function getOptionsList()
    {
        return [
            new InputOption(product::ARG_COUNT, null, InputOption::VALUE_REQUIRED, '(Required) Count is required'),
            new InputOption(product::ARG_WEBSITE, null, InputOption::VALUE_REQUIRED, '(Required) Website ID'),
            new InputOption(product::ARG_NAME, null, InputOption::VALUE_REQUIRED, '(Required) Name is required'),
            new InputOption(product::ARG_GENRE, null, InputOption::VALUE_REQUIRED, '(Required) Genre is required'),
            new InputOption(product::ARG_COMPANY, null, InputOption::VALUE_REQUIRED, '(Required) Company is required'),
            new InputOption(product::ARG_AUTHOR, null, InputOption::VALUE_REQUIRED, '(Required) Author is required'),
            new InputOption(product::ARG_PAGES, null, InputOption::VALUE_REQUIRED, '(Required) Pages is required'),
            new InputOption(product::ARG_PRICE, null, InputOption::VALUE_REQUIRED, '(Required) Price is required'),
            new InputOption(product::ARG_QTY, null, InputOption::VALUE_REQUIRED, '(Required) Qty is required'),
            new InputOption(product::ARG_STORE, null, InputOption::VALUE_REQUIRED, '(Required) Store is required'),
            new InputOption(product::ARG_CATEGORY, null, InputOption::VALUE_REQUIRED, '(Required) Category is required'),
            new InputOption(product::ARG_SUBCATEGORY, null, InputOption::VALUE_REQUIRED, '(Required) Subcategory is required'),
            new InputOption(product::ARG_IMAGE, null, InputOption::VALUE_REQUIRED, '(Required) Image is required'),
            new InputOption(product::ARG_DOWNLOADS, null, InputOption::VALUE_REQUIRED, '(Required) Image is required'),
            new InputOption(product::ARG_FILE, null, InputOption::VALUE_REQUIRED, '(Required) Image is required')
        ];
    }
}
