# emorfiq

Zezačátku bylo jasné, že se musí udělat abstraktní interfaces, které budou definovat rozhraní pro plánovač, úlohy a zámek. Zároveň, vzhledem k zadání vzájemné zaměnitelnosti Laravel/Crunz dva adaptéry plánovačů (jeden pro každého). A pak už jenom testovací úlohy. Základní rozvržení projektu bylo jednoduché, následně jsem ale pro urychlení a k pošťouchnutí použil AI pro laravel scheduler a vlastní souborý mutex. Ještě tam chybí další pomocné a ochranné funkce jako řešení v případě chyby, a tedy uzamčení celého procesu, logování do souboru a samotná integrace s Laravelem, protože jsem to dělal na standardním čistém composer projektu bez frameworku Laravel (jen používám Schedule třídu z Illuminate).

Jak otestovat:
1) Stáhnout a rozbalit
2) přes VS/CMD composer install
3) spustit "php spustit.php" (zde měnit typ adaptéru, Laravel bez napojení)
4) Případně upravovat samotné testovací úlohy