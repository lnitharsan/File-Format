<template>
	<div
		class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3"
		role="alert"
		v-if="hasMessage"
	>
		<div class="flex">
			<div>
				<p class="text-sm">{{ message }}</p>
			</div>
		</div>
	</div>

	<div
		class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3"
		role="alert"
		v-if="hasError"
	>
		<div class="flex">
			<div>
				<p class="text-sm">{{ error }}</p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	computed: {
		message() {
			return this.$page.props.flash.message;
		},

		hasMessage() {
			return this.message ? this.message.trim().length > 0 : false;
		},

		error() {
			return this.$page.props.flash.error;
		},

		hasError() {
			return this.error ? this.error.trim().length > 0 : false;
		},
	},
};
</script>