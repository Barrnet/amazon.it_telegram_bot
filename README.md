# amazon.it_telegram_bot
Bot di Telegram per generare ref link di amazon.it

Questo bot funziona tramite webhook, deve essere quindi hostato su un webserver raggiungibile dalle api di Telegram.
Dopo aver creato il bot con @BotFather, definisci nel file config.php le seguenti costanti:

1. BOT_TOKEN deve contenere la chiave API del bot
2. BOT_ID deve contenere il tag del bot come definito con BotFather, esempio @NomeBot
3. REF_AMZ deve contenere il tag ref di amazon da aggiungere all'indirizzo, es. ?ref=cicciopasticcio

Dopo aver modificato ed hostato i file, dovrai indicare come webhook a BotFather l'URL al file bot.php

