
#include "ScriptMgr.h"
#include "Player.h"
#include "Config.h"
#include "Chat.h"

class Promotion : public PlayerScript{
public:

    Promotion() : PlayerScript("Promotion") { }

    void OnLogin(Player* player) override
    {
        uint32 RealmId = sConfigMgr->GetIntDefault("RealmId", 1);
        uint32 Account = player->GetSession()->GetAccountId();
        uint32 Guid = player->GetSession()->GetGuidLow();
        QueryResult result = CharacterDatabase.PQuery("SELECT guid FROM character_promotion WHERE guid = %u AND account = %u AND entregado = 0 AND realm = %u", Guid, Account, RealmId);
        if (result)
            DefaultGift(player);
    }

    void DefaultGift(Player* player)
    {
        uint32 Money = sConfigMgr->GetIntDefault("MoneyGiven", 3000000);
        uint32 Level = sConfigMgr->GetIntDefault("LevelMax", 80);
        player->GiveLevel(Level);
        player->SetMoney(Money);
        CharacterDatabase.PExecute("UPDATE character_promotion SET entregado = 1 WHERE guid = %u", player->GetSession()->GetGuidLow());
        ChatHandler(player->GetSession()).SendSysMessage("Bienvenido al servidor!");
    }

};

class MyWorldScript : public WorldScript
{
public:

    MyWorldScript() : WorldScript("MyWorldScript") { }

    void OnBeforeConfigLoad(bool reload) override
    {
        if (!reload) {
            std::string conf_path = _CONF_DIR;
            std::string cfg_file = conf_path + "/Promotion.conf";
            sConfigMgr->LoadMore(cfg_file.c_str());
        }
    }
};

void AddPromotionScripts() {
    new Promotion();
    new MyWorldScript();
}

