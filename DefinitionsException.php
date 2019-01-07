<?php

class DefinitionsException extends Exception {}

class DifferentKeyAndNameException extends DefinitionsException {}

class noItemWithKeyDependenciesException extends DefinitionsException {}

class noDescriptionOfDependenciesException extends DefinitionsException {}

