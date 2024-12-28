# Diagramme de Classe

Voici le diagramme de classe de notre application :

```mermaid
classDiagram
    class User {
        +int id
        +string nom
        +string prenom
        +iscription()
    }

    class Account {
        +int id
        +string email
        +string password
    }

    class Role {
        <<enumeration>>
        +Etudiant
        +Prof
    }

    User --> Account : "possède un"
    User --> Role : "a un rôle"
