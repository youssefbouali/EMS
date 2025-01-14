classDiagram
    class User {
        +int id
        +string nom
        +string prenom
        +string role
        +string cne
        +string cni
        +string dateNaissance
        +inscription()
    }

    class Account {
        +int id
        +string email
        +string password
    }

    class Role {
        +Etudiant
        +Prof
    }

    class Note {
        +int id
        +float valeur
        +string commentaire
        +creerNote()
        +modifierNote()
        +supprimerNote()
    }

    class Module {
        +int id
        +string nom
        +ajouterModule()
        +modifierModule()
        +supprimerModule()
    }

    class Sector {
        +int id
        +string nom
        +string description
        +ajouterSector()
        +modifierSector()
        +supprimerSector()
    }

    %% Relations
    User --> Account : "possède un"
    Account --> Role : "a un rôle"
    User --> Note : "soumet"
    Note --> Module : "appartient à"
    Module --> Sector : "fait partie de"
    
    %% Rôle spécifique
    User : +string cne (visible si rôle = "Etudiant")
    User : +string cni (visible si rôle = "Prof")
    User : +string dateNaissance (visible si rôle = "Etudiant")

    %% Cardinalités
    User "1" --> "1" Account : "possède un"
    Account "1" --> "1" Role : "a un rôle"
    User "1" --> "0..*" Note : "soumet"
    Note "0..*" --> "1" Module : "appartient à"
    Module "1..*" --> "1" Sector : "fait partie de"
