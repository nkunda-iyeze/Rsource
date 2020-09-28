<template>
    <div>
        <form class=" " @submit.prevent="AddArticle">
  <div class="mb-6 mt-6 ">
    <div class="md:w-1/3 ">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        Title
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4  leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" v-model="article.title">
    </div>
  </div>
  <div class="mb-6 mt-6">
    <div class="md:w-1/3">
      <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        body
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4  leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" v-model="article.body">
    </div>
  </div>

  <div class="flex justify-center items-center ">
      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
        Save
    </button>
    </div>

</form>
    </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: "",
        title: "",
        body: ""
      },
      article_id: "",
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      page_url = page_url || "/api/v1/articles";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
          this.MakePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    MakePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deleteArticle(id) {
      if (confirm("are you sure you want to delete ?")) {
        axios
          .delete(`http://resource.test/api/v1/articles/${id}`)
          .then(data => {
            alert("Article Removed !");
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    AddArticle() {
      if (this.edit === false) {
        // addd
        axios
          .post("http://resource.test/api/v1/articles", {
            body: JSON.stringify(this.article),
            headers: {
              "content-type": "application/json"
            }
          })
          .then(data => {
            this.article.title = "";
            this.article.body = "";
            alert("article added");
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      } else {
        // update
      }
    }
  }
};
</script>

<style lang="sass" scoped>

</style>

