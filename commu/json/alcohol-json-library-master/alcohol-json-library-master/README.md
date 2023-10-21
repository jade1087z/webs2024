# alcohol-json-library

먹었던 술의 이런저런것들을 json으로 정리하는 곳  
Made by 머성

## 술의 종류

술의 대분류를 파일명으로 정한다. (술종류.json)

### 대분류

* soju - 소주
* beer - 맥주
* makgeolli - 막걸리
* yakju - 약주, 법주
* cheongju - 청주
* sake - 일본의 사케
* whisky - 위스키
* non-whisky - 보드카, 진, 럼, 데낄라 등등
* liqueur - 위 둘에 해당하지 않는 리큐르
* wine - 와인 (포도 only)
* fruit-wine - 포도가 아닌 과실로 만든 와인 (과실주, 한국와인)

## json 작성 구조

```json
{
    "category": (string 술의 종류),
    "alcList":
    [
        {
            "classification": (string 술의 소분류),
            "alcName": (string 술 이름),
            "alcDegree": (float 술의 도수),
            "alcMade": (string 술을 만든 양조장 또는 사람),
            "additonal":{ (실제 객관적인 술에 대한 정보를 저장해두는 곳)
                "price": (int 최근에 산 원화 가격 / 책정불가시 -1),
                "image": (string 술의 이미지 주소인데 가능한지 모름),
                "area": (string 술의 생산지),
                "krName": (string 외국 술일 경우 한글이름),
                "year": (int 병입연도 / 몇년산),
                "officialTag": [(string 실제 공식적으로 언급된 술을 소개하는 단어 및 형용사들의 array / #으로 시작함)],
                "siteLink": (string 이 술에 대한 설명이 있는 웹사이트의 주소),
                "vintage": (int 와인을 만들기 위해 포도를 수확한 해)
            },
            "review":{ (평가들의 평균값을 가져와서 저장해두는 곳)
                "score": (int 적당한 점수 / max min 없음),
                "taste": [(int 단, 쓴, 짠, 신, 맵, 감칠)],
                "again": (bool 다시 마실지),
                "userTag": [(string 유저가 술을 소개하는 단어 및 형용사들의 array / 많이 언급되는 순서 / #으로 시작함)]
            }
        },
        ...
    ]
}
```

술의 소분류는  
(classification) + (category) 시 자연스럽게 만든다.

    예시) "생" + "막걸리" -> "생 막걸리"

자세한 정보는 schema.json 참조

## 양조장

brewery.json에는 양조장에 대한 정보를 담는다.