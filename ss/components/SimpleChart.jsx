"use client";

export default function SimpleChart({ data, type = "bar" }) {
  if (!data || data.length === 0) {
    return <div className="text-gray-500 text-center py-8">No hay datos para mostrar</div>;
  }

  const maxValue = Math.max(...data.map(item => item.value));

  if (type === "pie") {
    const total = data.reduce((sum, item) => sum + item.value, 0);
    let currentAngle = 0;

    return (
      <div className="flex items-center justify-center">
        <div className="relative">
          <svg width="200" height="200" viewBox="0 0 200 200">
            {data.map((item, index) => {
              const percentage = (item.value / total) * 100;
              const angle = (item.value / total) * 360;
              const startAngle = currentAngle;
              const endAngle = currentAngle + angle;
              
              const x1 = 100 + 80 * Math.cos((startAngle - 90) * Math.PI / 180);
              const y1 = 100 + 80 * Math.sin((startAngle - 90) * Math.PI / 180);
              const x2 = 100 + 80 * Math.cos((endAngle - 90) * Math.PI / 180);
              const y2 = 100 + 80 * Math.sin((endAngle - 90) * Math.PI / 180);
              
              const largeArcFlag = angle > 180 ? 1 : 0;
              
              const pathData = [
                `M 100 100`,
                `L ${x1} ${y1}`,
                `A 80 80 0 ${largeArcFlag} 1 ${x2} ${y2}`,
                `Z`
              ].join(' ');
              
              currentAngle += angle;
              
              return (
                <path
                  key={index}
                  d={pathData}
                  fill={item.color}
                  stroke="white"
                  strokeWidth="2"
                />
              );
            })}
          </svg>
        </div>
        <div className="ml-6 space-y-2">
          {data.map((item, index) => (
            <div key={index} className="flex items-center space-x-2">
              <div 
                className="w-3 h-3 rounded-full" 
                style={{ backgroundColor: item.color }}
              ></div>
              <span className="text-sm">{item.name}: {item.value}</span>
            </div>
          ))}
        </div>
      </div>
    );
  }

  // Bar Chart
  return (
    <div className="space-y-4">
      <div className="flex items-end space-x-2 h-40">
        {data.map((item, index) => {
          const height = (item.value / maxValue) * 120;
          return (
            <div key={index} className="flex flex-col items-center flex-1">
              <div className="text-xs text-gray-600 mb-1">{item.value}</div>
              <div
                className="w-full rounded-t transition-all duration-300 hover:opacity-80"
                style={{
                  height: `${height}px`,
                  backgroundColor: item.color,
                  minHeight: '4px'
                }}
              ></div>
              <div className="text-xs text-gray-500 mt-2 text-center">
                {item.name}
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
}