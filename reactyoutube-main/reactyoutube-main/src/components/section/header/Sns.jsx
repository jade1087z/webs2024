import React from "react";

import { DiGithubBadge } from "react-icons/di";
import { IoLogoInstagram } from "react-icons/io5";
import { DiAptana } from "react-icons/di";
import { CiYoutube } from "react-icons/ci";

import { menuText, keywordText, SnsText } from "../../data/header";
const Sns = () => {
    return (
        <div className="header__sns">
            <ul>
                {SnsText.map((sns, key) => (
                    <li key={key}>
                        <a
                            href={sns.src}
                            target="_blank"
                            rel="nonopener noreferrer"
                        >
                            <span>{sns.icon}</span>
                        </a>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Sns;
