import { LuCat } from "react-icons/lu";
import { Link } from "react-router-dom";
import { WiDayHail } from "react-icons/wi";
import { DiGithubBadge } from "react-icons/di";
import { IoLogoInstagram } from "react-icons/io5";
import { DiAptana } from "react-icons/di";
import { CiFacebook } from "react-icons/ci";

import { CiYoutube } from "react-icons/ci";

export const menuText = [
    {
        title: "패션 유튜버 홈",
        icon: <WiDayHail />,
        src: "/youtuber",
    },
    {
        title: "오늘의 브랜드 탐험",
        icon: <WiDayHail />,
        src: "/youtuber",
    },
    {
        title: "SS시즌 아이템",
        icon: <WiDayHail />,
        src: "/youtuber",
    },
    {
        title: "FW시즌 아이템",
        icon: <WiDayHail />,
        src: "/youtuber",
    },
];

export const keywordText = [
    {
        icon: <LuCat />,
        title: "짱구대디",
        src: "/search/짱구대디",
    },
    {
        icon: <LuCat />,
        title: "핏더사이즈",
        src: "/search/핏더사이즈",
    },
    {
        icon: <LuCat />,
        title: "깡",
        src: "/search/깡",
    },
    {
        icon: <LuCat />,
        title: "호수",
        src: "/search/호수",
    },
    {
        icon: <LuCat />,
        title: "해수",
        src: "/search/해수",
    },
    {
        icon: <LuCat />,
        title: "썅마이웨이",
        src: "/search/썅마이웨이",
    },
];

export const SnsText = [
    {
        title: "gitHub",
        src: "https://github.com/jade1087z/webs2024",
        icon: <DiGithubBadge />,
    },
    {
        title: "Instagram",
        src: "https://www.instagram.com/sem/campaign/emailsignup/?campaign_id=13530338586&extra_1=s%7Cc%7C547419126410%7Ce%7Cinstagrame%7C&placement=&creative=547419126410&keyword=instagrame&partner_id=googlesem&extra_2=campaignid%3D13530338586%26adgroupid%3D126262418054%26matchtype%3De%26network%3Dg%26source%3Dnotmobile%26search_or_content%3Ds%26device%3Dc%26devicemodel%3D%26adposition%3D%26target%3D%26targetid%3Dkwd-299214942136%26loc_physical_ms%3D1009833%26loc_interest_ms%3D%26feeditemid%3D%26param1%3D%26param2%3D&gclid=Cj0KCQjwhL6pBhDjARIsAGx8D58v7L_AYG_rSqlXVuZsdKIiaT8yhQcljtJypOKeJwE5BR3ATAoPOe4aAoiAEALw_wcB",
        icon: <IoLogoInstagram />,
    },
    {
        title: "youTube",
        src: "https://www.youtube.com/",
        icon: <CiYoutube />,
    },
    {
        title: "FaceBook",
        src: "https://www.facebook.com/?locale=ko_KR",
        icon: <CiFacebook />,
    },
    {
        title: "setting",
        src: "/",
        icon: <DiAptana />,
    },
];
