<?php declare(strict_types=1);

namespace App\Model\Entity;

/**
 * Class Vozidlo
 *
 * @author Roman Piller
 */
final class Vozidlo
{
  /** @var string column id */
  public const ID = 'id';

  /** @var string column model */
  public const MODEL = 'model';

  /** @var string column registration */
  public const REGISTRATION = 'registration';

  /** @var string column color */
  public const COLOR = 'color';

  /** @var int id */
  private int $id;

  /** @var string model */
  private string $model;

  /** @var string registration */
  private string $registration;

  /** @var string|null color */
  private ?string $color;

  /**
   * Konstruct
   *
   * @param array<string, null|int|string> $data
   * @return void
   */
  public function __construct(array $data)
  {
  $this->id = (int)$data[self::ID];
  $this->model = (string)$data[self::MODEL];
  $this->registration = (string)$data[self::REGISTRATION];
  $this->color = $data[self::COLOR] === null ? null : (string)$data[self::COLOR];
  }

  /**
   * Konvert objektu na pole
   *
   * @return array<string, null|int|string>
   */
  public function toArray(): array
  {
   return [
     self::ID => $this->id,
     self::MODEL => $this->model,
     self::REGISTRATION => $this->registration,
     self::COLOR => $this->color,
   ];
  }

  /**
   * Getter id
   *
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Getter model
   *
   * @return string
   */
  public function getModel(): string
  {
    return $this->model;
  }

  /**
   * Getter registration
   *
   * @return string
   */
  public function getRegistration(): string
  {
    return $this->registration;
  }

  /**
   * Getter color
   *
   * @return string|null
   */
  public function getColor(): ?string
  {
    return $this->color;
  }

  /**
   * Setter model
   *
   * @param string $model
   * @return void
   */
  public function setModel(string $model): void
  {
    $this->model = $model;
  }

  /**
   * Setter color
   *
   * @param string|null $color
   * @return void
   */
  public function setColor(?string $color): void
  {
    $this->color = $color;
  }

  /**
   * Setter registration
   *
   * @param string $registration
   * @return void
   */
  public function setRegistration(string $registration): void
  {
    $this->registration = $registration;
  }
}
