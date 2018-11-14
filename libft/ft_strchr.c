/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strchr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 15:20:13 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 14:27:14 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strchr(const char *s, int c)
{
	char	ch;
	char	*tmp;
	int		i;

	ch = (unsigned char)c;
	i = 0;
	tmp = (char *)s;
	while (tmp[i])
	{
		if (tmp[i] == ch)
			return (&tmp[i]);
		i++;
	}
	if (!tmp[i] && !ch)
		return (&tmp[i]);
	return (NULL);
}
