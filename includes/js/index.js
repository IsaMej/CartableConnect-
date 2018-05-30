function selected(selec)
{
    if (selec == 1)
    {
        document.getElementById("debit").display = "inline";
        document.getElementById("miroir").display = "none";
        document.getElementById("video").display =  "none";
    }
    else if (selec == 2)
    {
        document.getElementById("debit").display = "none";
        document.getElementById("miroir").display = "inline";
        document.getElementById("video").display = "none";
    }
    else if (selec == 3)
    {
        document.getElementById("debit").display = "none";
        document.getElementById("miroir").display = "none";
        document.getElementById("video").display = "inline";
    }
}