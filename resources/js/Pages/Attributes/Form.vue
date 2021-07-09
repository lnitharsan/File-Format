<template>
	<breeze-authenticated-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Attributes
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 bg-white border-b border-gray-200">
						<div class="flex flex-col">
							<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="font-bold text-xl mb-4">Create Attribute</div>

									<breeze-validation-errors class="mb-4" />

									<form @submit.prevent="submit">
										<div>
											<breeze-label
												for="name"
												value="Name"
											/>
											<breeze-input
												id="name"
												type="text"
												class="mt-1 block w-full"
												v-model="form.name"
												required
												autofocus
												autocomplete="name"
											/>
										</div>

										<div class="flex items-center justify-end mt-4">
											<inertia-link
												:href="route('attributes')"
												class="underline text-sm text-gray-600 hover:text-gray-900"
											>
												Cancel
											</inertia-link>

											<breeze-button
												class="ml-4"
												:class="{ 'opacity-25': form.processing }"
												:disabled="form.processing"
											>
												Save
											</breeze-button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import Pagination from "@/Components/Pagination";
import ButtonLink from "@/Components/ButtonLink";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeButton from "@/Components/Button";
import BreezeValidationErrors from "@/Components/ValidationErrors";

export default {
	components: {
		BreezeAuthenticatedLayout,
		Pagination,
		ButtonLink,
		BreezeInput,
		BreezeLabel,
		BreezeButton,
		BreezeValidationErrors,
	},

	data() {
		return {
			form: this.$inertia.form({
				name: "",
			}),
		};
	},

	methods: {
		submit() {
			this.form.post(this.route("attributes.create"), {
				onFinish: () => this.form.reset("name"),
			});
		},
	},
};
</script>
