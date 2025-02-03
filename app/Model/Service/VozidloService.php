<?php

namespace App\Model\Service;

use App\Model\Repository\VozidloRepository;
use InvalidArgumentException;

class VozidloService
{
  /**
   * Constructor
   *
   * @param VozidloRepository $vozidloRepository
   */
  public function __construct(
    private readonly VozidloRepository $vozidloRepository)
  {
  }

  /**
   * Aktualizuje model vozidla
   *
   * @param int    $id
   * @param string $newModel
   * @return void
   * @throws InvalidArgumentException
   */
  public function updateVozidloModel(int $id, string $newModel): void
  {
    $vozidlo = $this->vozidloRepository->findById($id);
    $vozidlo->setModel($newModel);
    $this->vozidloRepository->update($vozidlo);
  }
}
