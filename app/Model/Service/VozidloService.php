<?php

namespace App\Model\Service;

use App\Model\Entity\Vozidlo;
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
   * Vrati vozidlo podla vozidlo Id
   *
   * @param int $vozidloId
   * @return Vozidlo
   * @throws InvalidArgumentException
   */
  public function getVozidlo(int $vozidloId): Vozidlo
  {
    return $this->vozidloRepository->findById($vozidloId);
  }

  /**
   * Aktualizuje model vozidla
   *
   * @param int    $vozidloId
   * @param string $newModel
   * @return void
   * @throws InvalidArgumentException
   */
  public function updateVozidloModel(int $vozidloId, string $newModel): void
  {
    $vozidlo = $this->vozidloRepository->findById($vozidloId);
    $vozidlo->setModel($newModel);
    $this->vozidloRepository->update($vozidlo);
  }
}
