<?php declare(strict_types=1);

namespace App\UI\GridExample;

use Nette\Application\UI\Presenter;
use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\Database\Table;
use Ublaboo\DataGrid\DataGrid;

/**
 * Class GridExamplePresenter
 *
 * @author Roman Piller
 */
final class GridExamplePresenter extends Presenter
{
  public function __construct(private Explorer $database)
  {
    parent::__construct();
  }

  public function createComponentSimpleGrid($name = 'cities'): DataGrid
  {
    $grid = new Datagrid($this, $name);

    $grid->setDataSource($this->database->table('cities'));
    $grid->addColumnText('city', 'city');

    return $grid;
  }
}
