erDiagram
    USER {
        int id PK
        string nom
        string prenom
        string role
        string cne
        string cni
        date dateNaissance
    }

    ACCOUNT {
        int id PK
        string email
        string password
    }

    ROLE {
        string roleName PK
    }

    NOTE {
        int id PK
        float valeur
        string commentaire
    }

    MODULE {
        int id PK
        string nom
    }

    SECTOR {
        int id PK
        string nom
        string description
    }

    %% Relations
    USER ||--o| ACCOUNT : "possède un"
    ACCOUNT ||--|| ROLE : "a un rôle"
    USER ||--o{ NOTE : "soumet"
    NOTE }o--|| MODULE : "appartient à"
    MODULE }o--|| SECTOR : "fait partie de"
