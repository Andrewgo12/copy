"use client";

import { Card, CardContent } from "@/components/ui/card";

export default function StatsCard({ title, value, icon: Icon, color = "blue", trend }) {
  const colorClasses = {
    blue: "text-blue-600 bg-blue-50",
    green: "text-green-600 bg-green-50",
    yellow: "text-yellow-600 bg-yellow-50",
    red: "text-red-600 bg-red-50",
    purple: "text-purple-600 bg-purple-50"
  };

  return (
    <Card className="hover:shadow-md transition-shadow">
      <CardContent className="p-6">
        <div className="flex items-center justify-between">
          <div>
            <p className="text-sm font-medium text-gray-600">{title}</p>
            <p className="text-3xl font-bold text-gray-900">{value}</p>
            {trend && (
              <p className={`text-sm ${trend.positive ? 'text-green-600' : 'text-red-600'}`}>
                {trend.positive ? '↗' : '↘'} {trend.value}
              </p>
            )}
          </div>
          {Icon && (
            <div className={`p-3 rounded-full ${colorClasses[color]}`}>
              <Icon className="w-6 h-6" />
            </div>
          )}
        </div>
      </CardContent>
    </Card>
  );
}