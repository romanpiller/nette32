<?php declare(strict_types=1);

namespace App\Model\Entity;

/**
 * Class Osoba
 *
 * @author Roman Piller
 */
final class Osoba
{
  /** @var string column id */
  public const ID = 'id';

  /** @var string column name */
  public const NAME = 'name';

  /** @var string column age */
  public const AGE = 'age';

  /** @var string column birth_date */
  public const BIRTHDATE = 'birth_date';

  /** @var int id */
  private int $id;

  /** @var string name */
  private string $name;

  /** @var int|null age */
  private ?int $age;

  /** @var string|null birthdate*/
  private ?string $birthDate;

  /**
   * Konstruct
   *
   * @param array<string, null|int|string> $data
   * @return void
   */
  public function __construct(array $data)
  {
    $this->id = (int)$data[self::ID];
    $this->name = (string)$data[self::NAME];
    $this->age = (int)$data[self::AGE];
    $this->birthDate = $data[self::BIRTHDATE] === null ? null : (string)$data[self::BIRTHDATE];
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
      self::NAME => $this->name,
      self::AGE => $this->age,
      self::BIRTHDATE => $this->birthDate,
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
   * Getter name
   *
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Getter age
   *
   * @return int|null
   */
  public function getAge(): ?int
  {
    return $this->age;
  }

  /**
   * Getter birthday
   *
   * @return string|null
   */
  public function getBirthDate(): ?string
  {
    return $this->birthDate;
  }

  /**
   * Setter name
   *
   * @param string $name
   * @return void
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * Setter age
   *
   * @param int|null $age
   * @return void
   */
  public function setAge(?int $age): void
  {
    $this->age = $age;
  }

  /**
   * Setter birhdate
   *
   * @param string|null $birthDate
   * @return void
   */
  public function setBirthDate(?string $birthDate): void
  {
    $this->birthDate = $birthDate;
  }
}
