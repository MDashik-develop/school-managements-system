@extends('layouts.student')

@section('content')

<!-- Main dashboard content with scroll -->
<div class="p-4 sm:p-6 lg:p-8">
   <!-- Dashboard Header -->
   <div class="mb-8">
      <h1 class="text-3xl font-bold text-slate-900">ড্যাশবোর্ড</h1>
      <p class="mt-1 text-slate-500">আপনার নিউজ পোর্টালের সকল কার্যক্রমের সারসংক্ষেপ।</p>
   </div>

   <!-- Stats Cards Grid -->
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Card 1: Total Posts -->
      <div
         class="bg-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
         <div class="flex justify-between items-start">
            <div>
               <p class="text-sm font-medium text-slate-500">সর্বমোট পোস্ট</p>
               <p class="text-3xl font-bold text-slate-900 mt-1">১২,৮৬০</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
               <i data-feather="file-text" class="text-blue-600"></i>
            </div>
         </div>
      </div>
      <!-- Card 2: Published Posts -->
      <div
         class="bg-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
         <div class="flex justify-between items-start">
            <div>
               <p class="text-sm font-medium text-slate-500">প্রকাশিত পোস্ট</p>
               <p class="text-3xl font-bold text-slate-900 mt-1">১০,২০০</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
               <i data-feather="check-circle" class="text-green-600"></i>
            </div>
         </div>
      </div>
      <!-- Card 3: Drafts -->
      <div
         class="bg-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
         <div class="flex justify-between items-start">
            <div>
               <p class="text-sm font-medium text-slate-500">খসড়া পোস্ট</p>
               <p class="text-3xl font-bold text-slate-900 mt-1">১৫</p>
            </div>
            <div class="bg-amber-100 p-3 rounded-full">
               <i data-feather="edit-3" class="text-amber-600"></i>
            </div>
         </div>
      </div>
      <!-- Card 4: Visitors -->
      <div
         class="bg-white p-6 rounded-xl shadow-md border border-slate-200 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
         <div class="flex justify-between items-start">
            <div>
               <p class="text-sm font-medium text-slate-500">আজকের ভিজিটর</p>
               <p class="text-3xl font-bold text-slate-900 mt-1">৮৯,৪৫০</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
               <i data-feather="users" class="text-red-600"></i>
            </div>
         </div>
      </div>
   </div>

   <!-- Main Content Grid -->
   <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left Column: Recent Posts & Chart -->
      <div class="lg:col-span-2 space-y-8">
         <!-- Visitor Statistics Chart -->
         <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">ভিজিটর পরিসংখ্যান (শেষ ৭ দিন)</h3>
            <div class="h-80">
               <canvas id="visitorsChart"></canvas>
            </div>
         </div>

         <!-- Recent Posts Table -->
         <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
            <div class="p-6">
               <h3 class="text-lg font-semibold text-slate-900">সাম্প্রতিক পোস্টসমূহ</h3>
            </div>
            <div class="overflow-x-auto">
               <table class="w-full text-sm text-left">
                  <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                     <tr>
                        <th scope="col" class="px-6 py-3 font-medium">শিরোনাম</th>
                        <th scope="col" class="px-6 py-3 font-medium">ক্যাটেগরি</th>
                        <th scope="col" class="px-6 py-3 font-medium">স্ট্যাটাস</th>
                        <th scope="col" class="px-6 py-3 font-medium">ভিউ</th>
                        <th scope="col" class="px-6 py-3 font-medium">একশন</th>
                     </tr>
                  </thead>
                  <tbody class="divide-y divide-slate-200">
                     <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">পদ্মা সেতুর নতুন টোল হার কার্যকর</td>
                        <td class="px-6 py-4 text-slate-600">জাতীয়</td>
                        <td class="px-6 py-4"><span
                              class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">প্রকাশিত</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">২.৫ হাজার</td>
                        <td class="px-6 py-4 flex gap-2"><a href="#"
                              class="text-indigo-600 hover:text-indigo-800">ইডিট</a><a href="#"
                              class="text-red-600 hover:text-red-800">ডিলিট</a></td>
                     </tr>
                     <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">বিশ্বকাপ ফুটবলে নতুন চমক</td>
                        <td class="px-6 py-4 text-slate-600">খেলাধুলা</td>
                        <td class="px-6 py-4"><span
                              class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">প্রকাশিত</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">৮.২ হাজার</td>
                        <td class="px-6 py-4 flex gap-2"><a href="#"
                              class="text-indigo-600 hover:text-indigo-800">ইডিট</a><a href="#"
                              class="text-red-600 hover:text-red-800">ডিলিট</a></td>
                     </tr>
                     <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">স্মার্টফোনের বাজারে নতুনত্বের ছোঁয়া</td>
                        <td class="px-6 py-4 text-slate-600">প্রযুক্তি</td>
                        <td class="px-6 py-4"><span
                              class="px-2 py-1 text-xs font-semibold text-amber-800 bg-amber-100 rounded-full">খসড়া</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">--</td>
                        <td class="px-6 py-4 flex gap-2"><a href="#"
                              class="text-indigo-600 hover:text-indigo-800">ইডিট</a><a href="#"
                              class="text-red-600 hover:text-red-800">ডিলিট</a></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <!-- Right Column: Quick Actions & Categories -->
      <div class="space-y-8">
         <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">জনপ্রিয় ক্যাটেগরি</h3>
            <div class="space-y-4">
               <div>
                  <div class="flex justify-between mb-1"><span
                        class="text-sm font-medium text-slate-700">জাতীয়</span><span
                        class="text-sm font-medium text-slate-500">৪০%</span></div>
                  <div class="w-full bg-slate-200 rounded-full h-2.5">
                     <div class="bg-blue-600 h-2.5 rounded-full" style="width: 40%"></div>
                  </div>
               </div>
               <div>
                  <div class="flex justify-between mb-1"><span
                        class="text-sm font-medium text-slate-700">আন্তর্জাতিক</span><span
                        class="text-sm font-medium text-slate-500">২৫%</span></div>
                  <div class="w-full bg-slate-200 rounded-full h-2.5">
                     <div class="bg-teal-500 h-2.5 rounded-full" style="width: 25%"></div>
                  </div>
               </div>
               <div>
                  <div class="flex justify-between mb-1"><span
                        class="text-sm font-medium text-slate-700">খেলাধুলা</span><span
                        class="text-sm font-medium text-slate-500">২০%</span></div>
                  <div class="w-full bg-slate-200 rounded-full h-2.5">
                     <div class="bg-orange-500 h-2.5 rounded-full" style="width: 20%"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">কুইক অ্যাকশন</h3>
            <div class="flex flex-col space-y-3">
               <a href="#" class="w-full text-left p-3 rounded-lg hover:bg-slate-100 transition-colors">ক্যাটেগরি
                  ম্যানেজ</a>
               <a href="#" class="w-full text-left p-3 rounded-lg hover:bg-slate-100 transition-colors">কমেন্ট
                  ম্যানেজ</a>
               <a href="#" class="w-full text-left p-3 rounded-lg hover:bg-slate-100 transition-colors">ইউজার
                  ম্যানেজ</a>
               <a href="#" class="w-full text-left p-3 rounded-lg hover:bg-slate-100 transition-colors">সাইট
                  সেটিংস</a>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection