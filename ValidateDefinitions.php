<?php
require_once('DefinitionsException.php');

class ValidateDefinitions
{
    /**
     * @param array $packages
     */
    public function validatePackageDefinitions(array $packages): void
    {
        $this->nameKeyMatch($packages);
        $this->itemWithKeyDependencies($packages);
        $this->descriptionOfDependencies($packages);
    }

    /**
     * @param array $packages
     */
    private function nameKeyMatch(array $packages): void
    {
        $keyName = 0;

        foreach ($packages as $key => $value) {
            if ($key == $value['name'])
            {
                $keyName++;
                echo "The array key is the same as its name <br>";
            }
            else
            {
                try {
                    throw new DifferentKeyAndNameException("Key $key does not match with $value[name] <br>");
                }
                catch(Exception $e) {
                    echo $e->getMessage();
                 }
            }


        }
    }

    /**
     * @param array $packages
     */
    private function itemWithKeyDependencies(array $packages): void
    {
        $keyExist = 0;

        foreach ($packages as $key => $value) {
            if(array_key_exists("dependencies", $value))
            {
                $keyExist++;
                echo "Key $key has an item with a key dependencies <br>";
            }
            else {
                try {
                    throw new noItemWithKeyDependenciesException("Key $key does not have an item with a key dependencies <br>");
                }
                catch(Exception $e) {
                    echo $e->getMessage();
                }
            }

        }
    }

    /**
     * @param array $packages
     */
    private function descriptionOfDependencies(array $packages): void
    {
        $dependencies = "dependencies";
        $n = 0;

        foreach($packages as $key3 => $value3)
        {
            $arrayOfKeys[$n] = $key3;
            $n++;
        }

        foreach ($packages as $key => $value) {

            $i = 0;

            if (empty($value[$dependencies]))
            {
                try {
                throw new noDescriptionOfDependenciesException("The key points to an empty cell <br>");
                }
                catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
            else
            {
                echo "The dependencies indicate the described dependencies: ";
                foreach($value[$dependencies] as $key2 => $value2)
                {
                    for ($l = 0; $l <= count($arrayOfKeys); $l++)
                    {
                        $newArray[$l] = ['$arrayOfKeys[$l]' => [$value2]];
                    }

                    $arrayOfDependencies[$i] = $value2;
                    echo "$value2 ";
                    $i++;
                }
                echo "<br>";
            }
        }
    }
}