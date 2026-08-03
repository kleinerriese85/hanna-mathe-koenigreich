# Hannas Mathe-Königreich

Mathe-Übungsspiel für Hanna (3. Klasse): Plus, Minus, Einmaleins, Königs-Mix,
Zahlen-Zauberschule — mit Cloud-Spielstand über `spielstand.php`.

Eine einzige HTML-Datei (`index.html`) plus ein Mini-PHP-Endpoint. Der Spielstand
wird als `spielstand-hanna.json` in `/data` (Volume) gespeichert; alle Geräte,
die dieselbe URL öffnen, teilen sich den Fortschritt (Merge per Feld-Maximum,
Fortschritt kann nie zurückfallen).

## Deployment (Coolify)

1. **Projekt/Resource anlegen:** + New → Private Repository (GitHub App) →
   dieses Repo wählen. Build Pack: **Dockerfile**. Port: **80**.
2. **Persistent Storage:** Storages → Volume Mount → Destination `/data`
   (Name z. B. `hanna-data`). Ohne Volume geht der Spielstand bei jedem
   Redeploy verloren.
3. **Domain:** z. B. `mathe.robinriesenbeck.de` eintragen; im DNS ein
   A-Record auf den Hetzner-Server (gleiche IP wie die anderen Coolify-Apps).
4. Deploy. Check: Startseite lädt, und `/spielstand.php` antwortet `null`
   (bzw. JSON, sobald gespielt wurde). Im Spiel: Elternbereich (Code 1234) →
   „✓ Cloud-Speicher aktiv".

## Hinweise

- localStorage-Key im Spiel: `hannah-mathe-v1` — bei Updates nie umbenennen.
- Elternbereich-Code: 1234 (Kindersicherung, keine echte Security).
- `index.html` ist identisch mit dem Claude-Artifact; Updates dort einfach
  hier committen und redeployen.
