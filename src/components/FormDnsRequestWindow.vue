<script>
export default {
  data() {
    return {
      domain: '',
      hideResultBox: false,
      result: null
    }
  },
  methods: {
    reqDns() {
      this.$data.result = null;
      console.debug("FormDnsRequestWindow.11", this.$data.domain);

      if (this.$data.domain.trim().length < 3) {
        alert('Please enter a domain name');
        return;
      }

      fetch('https://dns-viewer.hemk.es/dig.php?domain=' + this.$data.domain)
          .then(response => response.json())
          .then((json) => {
            console.debug("FormDnsRequestWindow.17", json);
            setTimeout(() => {
              this.$data.result = json;
            }, 220)
          })
    }
  }
}
</script>
<template>

  <header>
    <div class="greetings">
      <h1>DNS.view</h1><br/>
      <span>by <a href="https://hemk.es/" target="_blank" rel="author external" title="author of this project">@turbopixel</a></span>
    </div>

    <div class="formular">
      <div class="field">
        <label for="" class="label">Enter domain</label>
        <div class="control">
          <input type="text" name="domain" id="domain" v-model="domain" required minlength="3" @keyup.enter="reqDns" class="input-text" placeholder="domain.tld">
        </div>
      </div>
    </div>
  </header>

  <div id="resultbox" class="resultbox" v-if="result">
    <table width="100%" v-for="row in result">
      <tr v-if="row.type === 'A'">
        <td width="60">{{ row.type }}</td>
        <td>{{ row.ip }}</td>
      </tr>
      <tr v-if="row.type === 'AAAA'">
        <td width="60">{{ row.type }}</td>
        <td>{{ row.ipv6 }}</td>
      </tr>
      <tr v-if="row.type === 'MX'">
        <td width="60">{{ row.type }}</td>
        <td>({{ row.pri }}) {{ row.target }}</td>
      </tr>
      <tr v-if="row.type === 'CNAME'">
        <td width="60">{{ row.type }}</td>
        <td>{{ row.target }}</td>
      </tr>
      <tr v-if="row.type === 'TXT'">
        <td width="60">{{ row.type }}</td>
        <td>
          <div style="overflow: hidden">{{ row.txt }}</div>
        </td>
      </tr>
      <tr v-if="row.type === 'NS'">
        <td width="60">{{ row.type }}</td>
        <td>{{ row.target }}</td>
      </tr>
    </table>
  </div>

</template>

<style>
header{
  display: block;
}

@media (min-width: 1024px){
  header{
    display: grid;
    grid-template-columns: 300px auto;
  }
}

.greetings{
  display: flex;
  place-items: center;
  font-weight: 800;
  text-decoration: none;
  transition: 0.4s;
  flex-direction: column;
  font-size: 1.25rem;
  color: var(--color-heading);
  line-height: 2rem;
}

.greetings span{
  font-size: 0.9rem;
  color: var(--color-text);
}

.greetings a{
  font-size: 0.9rem;
  color: var(--color-text);
  text-decoration: none;
  transition: 220ms color;
}

.greetings a:hover{
  color: var(--color-label);
}

@media (min-width: 1024px){
  .formular{
    margin: 0 auto;
    padding: 3rem;
    width: calc(100% - 6rem);
  }
}

.field{
  display: block;
}

.field label{
  font-size: 0.75rem;
  font-weight: 800;
  color: var(--color-heading);
  text-transform: uppercase;
  letter-spacing: 1px;
  justify-content: space-between;
  display: block;
}

.field .input-text{
  display: block;
  padding: 1rem;
  width: 100%;
  border: none;
  background: hsl(150, 18%, 96%);
  font-weight: 600;
  letter-spacing: 1px;
  font-size: 1rem;
  color: var(--color-background-pad);
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.09);
  transition: 250ms all;
}

.field .input-text:focus,
.field .input-text:hover{
  border: none;
  outline: none;
}

.field .input-text:focus{
  color: var(--color-background-pad);
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.22);
}

.resultbox{
  display: block;
  width: 100%;
  background: var(--color-label);
  color: var(--color-background);
  border-radius: 0 0 7px 7px;
  padding: 1rem;
  font-size: 1rem;
  font-family: monospace;
}

</style>