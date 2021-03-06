<?php

class Base_AnimalTwigController extends TwigBaseController
{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT id, name FROM animals_types");
        $types = $query->fetchAll();
        $context['types'] = $types;

        return $context;
    }
}
