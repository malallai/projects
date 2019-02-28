/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_atoi.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 09:33:45 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/14 12:36:06 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"
#include "limits.h"

int	ft_atoi(const char *str)
{
	unsigned int	i;
	int				neg;
	long long		b;

	i = 0;
	neg = 0;
	while (str[i] && (str[i] == '\r' || str[i] == '\t' || str[i] == ' '
				|| str[i] == '\v' || str[i] == '\f' || str[i] == '\n'))
		i++;
	if (str[i] == '+' || str[i] == '-')
	{
		if (str[i] == '-')
			neg = 1;
		i++;
	}
	b = 0;
	while (ft_isdigit(str[i]))
	{
		b = (b * 10) + (str[i] - '0');
		i++;
	}
	b = neg ? (int)-b : (int)b;
	return (b);
}
