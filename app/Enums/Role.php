<?php

namespace App\Enums;

// création roles admin et utilisateur par défaut
// ces rôles seront ajoutés sous forme de colonne dans la table BDD users
enum Role: string
{
    case Admin = 'admin';
    case Default = 'default';
}