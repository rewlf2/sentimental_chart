const data = require("./author.json"),
    wordcloud = require("./wordcloud.json").data,
    posts = require("./posts.json").posts,
    sortByValue = (a,b) => {
        return a[1] > b[1] ? 1 : 
            a[1] < b[1] ? -1 : 
            a[0] > b[0] ? 1 :
            a[0] < b[0] ? -1 : 
            0;
    };

console.log(Object.keys(wordcloud).length);


// for(const [name, value] of new Map(Object.entries(data.data).sort(sortByValue).reverse()))
//     process.stdout.write(`name: ${name}\n` + `value: ${value}\n\n`);

// let collection = [];
// for(const post of posts){
//     let each = [];
//     for(const categoryScore of post.categoryScores)
//         each.push(categoryScore.score);

//     collection.push(each);
// }

// for(const data of collection){
//     console.log(data);
//    process.stdout.write(',');
// }


